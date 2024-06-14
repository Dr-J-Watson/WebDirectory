import 'package:webdirapp/screens/entry_provider.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'web_dir_app.dart';

Future<void> main() async {

  WidgetsFlutterBinding.ensureInitialized();

  runApp(ChangeNotifierProvider(
    create: (context) => EntryProvider(),
    child: const WebDirApp(),
  ),
  );
}

